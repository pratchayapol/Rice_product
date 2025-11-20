<?php
// --- PHP proxy mode ---
if (isset($_GET['proxy'])) {
    $path = null;
    $method = $_SERVER['REQUEST_METHOD'];

    if ($_GET['proxy'] === 'auth-token') {
        $path = '/api/v1/auth/token';
    } elseif ($_GET['proxy'] === 'rices') {
        $path = '/api/v1/rices/public' . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
    } elseif ($_GET['proxy'] === 'metadata') {
        $path = '/api/v1/rices/public/any/metadata';
    }

    if ($path === null) {
        http_response_code(404);
        echo json_encode(['error' => 'Unknown proxy']);
        exit;
    }

    $url = 'https://gene-bank.trsi-app.ricethailand.go.th' . $path;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // headers จาก client
    $headers = ['Accept: application/json'];
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if ($contentType) {
        $headers[] = 'Content-Type: ' . $contentType;
    }
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    if ($authHeader) {
        $headers[] = 'Authorization: ' . $authHeader;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        $body = file_get_contents('php://input');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }

    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    http_response_code($status);
    header('Content-Type: application/json');
    echo $response;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rice gene bank API - Swagger UI</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css">
    <style>
        body { margin: 0; }
        #swagger-ui { width: 100%; height: 100vh; }
    </style>
</head>
<body>
<div id="swagger-ui"></div>

<script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
<script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-standalone-preset.js"></script>
<script>
const spec = {
  openapi: "3.0.0",
  info: {
    title: "Rice gene bank API",
    version: "1.0.0",
    description: ""
  },
  servers: [
    { url: "" } // เรียกกลับมาที่ swagger.php ตัวนี้เอง
  ],
  components: {
    securitySchemes: {
      BearerAuth: {
        type: "http",
        scheme: "bearer",
        bearerFormat: "JWT"
      }
    }
  },
  paths: {
    "/swagger.php?proxy=auth-token": {
      post: {
        summary: "1. ขอ access token",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  client_id: { type: "string" },
                  client_secret: { type: "string" }
                },
                required: ["client_id", "client_secret"]
              },
              example: {
                client_id: "4cxr9vqrcu98d47",
                client_secret: "FpLhAYx496VZWqOPcqP29u9RNF3Z701i59gam0BsiiLs9f6p98F5tlZ04aL3" // อย่าใส่ตัวจริงใน public
              }
            }
          }
        },
        responses: {
          200: {
            description: "สำเร็จ: คืน access_token"
          }
        }
      }
    },
    "/swagger.php?proxy=rices": {
      get: {
        summary: "2. ใช้ Access Token เพื่อดึงข้อมูลข้าว",
        security: [{ BearerAuth: [] }],
        parameters: [
          {
            name: "page",
            in: "query",
            required: false,
            schema: { type: "integer", default: 1 }
          },
          {
            name: "take",
            in: "query",
            required: false,
            schema: { type: "integer", default: 100 }
          }
        ],
        responses: {
          200: { description: "รายการข้อมูลข้าว" }
        }
      }
    },
    "/swagger.php?proxy=metadata": {
      get: {
        summary: "3. ยิงเอาหัวเรื่อง (metadata)",
        security: [{ BearerAuth: [] }],
        responses: {
          200: { description: "metadata ของข้อมูลข้าว" }
        }
      }
    }
  }
};

window.onload = function () {
  SwaggerUIBundle({
    spec: spec,
    dom_id: '#swagger-ui',
    deepLinking: true,
    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset
    ],
    layout: "StandaloneLayout"
  });
};
</script>
</body>
</html>
