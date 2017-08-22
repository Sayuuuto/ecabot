<!doctype html>
<html>
<head>

</head>
<body>
<script>
    app.get('/webhook', function(req, res) {
        if (req.query['hub.mode'] === 'subscribe' &&
            req.query['hub.verify_token'] === <eca_bot>) {
            console.log("Validating webhook");
            res.status(200).send(req.query['hub.challenge']);
        } else {
            console.error("Failed validation. Make sure the validation tokens match.");
            res.sendStatus(403);
        }
    });
</script>
</body>
</html>
