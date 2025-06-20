<!-- index.html -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Custom fonts for this template-->
  <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
  <title>Swagger UI</title>
  <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist/swagger-ui.css" />
</head>

<body>
  <div id="swagger-ui"></div>
  <script src="https://unpkg.com/swagger-ui-dist/swagger-ui-bundle.js"></script>
  <script>
    SwaggerUIBundle({
      url: "api-docs.yaml",
      dom_id: '#swagger-ui'
    });
  </script>
</body>

</html>