<!DOCTYPE html>
<html>
  <head>
    <title>Swagger UI for PHP API</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist/swagger-ui.css" />
  </head>
  <body>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist/swagger-ui-bundle.js"></script>
    <script>
      window.onload = () => {
        SwaggerUIBundle({
          url: "/docs/swagger.yaml", // หรือ .json ถ้าคุณใช้ JSON
          dom_id: "#swagger-ui"
        });
      };
    </script>
  </body>
</html>
