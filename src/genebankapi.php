<?php
// swagger.php
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
            {
                url: "https://gene-bank.trsi-app.ricethailand.go.th"
            }
        ],
        components: {
            securitySchemes: {
                BearerAuth: {
                    type: "http",
                    scheme: "bearer",
                    bearerFormat: "JWT",
                    description: "เอา access_token จาก /api/v1/auth/token มาใส่ตรง Authorize (ไม่ต้องพิมพ์คำว่า Bearer)"
                }
            }
        },
        paths: {
            "/api/v1/auth/token": {
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
                                    client_secret: "FpLhAYx496VZWqOPcqP29u9RNF3Z701i59gam0BsiiLs9f6p98F5tlZ04aL3"
                                }
                            }
                        }
                    },
                    responses: {
                        200: {
                            description: "สำเร็จ: คืน access_token",
                            content: {
                                "application/json": {
                                    schema: {
                                        type: "object",
                                        properties: {
                                            access_token: { type: "string" },
                                            token_type: { type: "string" },
                                            expires_in: { type: "integer" }
                                        }
                                    },
                                    example: {
                                        access_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.xxx.yyy",
                                        token_type: "Bearer",
                                        expires_in: 86400
                                    }
                                }
                            }
                        },
                        400: { description: "Bad request" },
                        401: { description: "Unauthorized" }
                    }
                }
            },
            "/api/v1/rices/public": {
                get: {
                    summary: "2. ใช้ Access Token เพื่อดึงข้อมูลข้าว",
                    security: [
                        { BearerAuth: [] }
                    ],
                    parameters: [
                        {
                            name: "page",
                            in: "query",
                            required: false,
                            schema: {
                                type: "integer",
                                default: 1
                            },
                            description: "หน้าที่ต้องการ"
                        },
                        {
                            name: "take",
                            in: "query",
                            required: false,
                            schema: {
                                type: "integer",
                                default: 100
                            },
                            description: "จำนวนรายการต่อหน้า"
                        }
                    ],
                    responses: {
                        200: {
                            description: "รายการข้อมูลข้าว",
                            content: {
                                "application/json": {
                                    schema: {
                                        type: "object"
                                    }
                                }
                            }
                        },
                        401: { description: "Unauthorized หรือ token หมดอายุ" }
                    }
                }
            },
            "/api/v1/rices/public/any/metadata": {
                get: {
                    summary: "3. ยิงเอาหัวเรื่อง (metadata)",
                    security: [
                        { BearerAuth: [] }
                    ],
                    responses: {
                        200: {
                            description: "metadata ของข้อมูลข้าว",
                            content: {
                                "application/json": {
                                    schema: {
                                        type: "object"
                                    }
                                }
                            }
                        },
                        401: { description: "Unauthorized หรือ token หมดอายุ" }
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
