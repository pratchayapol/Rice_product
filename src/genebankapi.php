<?php
// swagger.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rice gene bank API - Swagger UI</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist/swagger-ui.css">
    <style>
        body { margin: 0; }
        #swagger-ui { width: 100%; height: 100vh; }
    </style>
</head>
<body>
<div id="swagger-ui"></div>

<script src="https://unpkg.com/swagger-ui-dist/swagger-ui-bundle.js"></script>
<script src="https://unpkg.com/swagger-ui-dist/swagger-ui-standalone-preset.js"></script>
<script>
    // แปลง OpenAPI ด้านบนเป็น JSON แล้วฝังไว้ตรงนี้
    const spec = {
        "openapi": "3.0.0",
        "info": {
            "title": "Rice gene bank API",
            "version": "1.0.0",
            "description": ""
        },
        "servers": [
            {
                "url": "https://gene-bank.trsi-app.ricethailand.go.th"
            }
        ],
        "paths": {
            "/api/v1/auth/token": {
                "post": {
                    "summary": "1.ขอ access token",
                    "tags": [],
                    "requestBody": {
                        "content": {
                            "application/json": {
                                "schema": {
                                    "type": "object",
                                    "properties": {
                                        "client_id": {
                                            "type": "string"
                                        },
                                        "client_secret": {
                                            "type": "string"
                                        }
                                    }
                                }
                            }
                        }
                    },
                    "responses": {}
                }
            },
            "/api/v1/rices/public": {
                "get": {
                    "summary": "2. ใช้ Access Token เพื่อดึงข้อมูลข้าว",
                    "tags": [],
                    "parameters": [
                        {
                            "name": "page",
                            "in": "query",
                            "schema": {
                                "type": "integer"
                            }
                        },
                        {
                            "name": "take",
                            "in": "query",
                            "schema": {
                                "type": "integer"
                            }
                        },
                        {
                            "name": "Authorization",
                            "in": "header",
                            "schema": {
                                "type": "string"
                            }
                        }
                    ],
                    "responses": {}
                }
            },
            "/api/v1/rices/public/any/metadata": {
                "get": {
                    "summary": "3.ยิงเอาหัวเรื่อง",
                    "tags": [],
                    "parameters": [
                        {
                            "name": "Authorization",
                            "in": "header",
                            "schema": {
                                "type": "string"
                            }
                        }
                    ],
                    "responses": {}
                }
            }
        }
    };

    window.onload = () => {
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
