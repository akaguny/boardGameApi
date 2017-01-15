<?php
// Routes

// Регистрация
$app->post('/register', function ($request, $response, $args) {
    $user = "root";
    $hash = password_hash("vgfzdgwR", PASSWORD_DEFAULT);
    $this->logger->info($status);

    $status = $this->db->exec(
        "INSERT INTO users (user, hash) VALUES ('{$user}', '{$hash}')"
    );

    $this->logger->info($status);
});

// Логин
$app->post('/login', function ($request, $response, $args) {
    $parsedBody = $request->getParsedBody();
    $body = $request->getBody();
//    $this->logger->info($this->response->withJson($parsedBody));
    $this->logger->trace($body);

    return $parsedBody;
});

// get all placeholercards
$app->get('/placeholercards', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM cardHolders ORDER BY id");
    $sth->execute();
    $cards = $sth->fetchAll();

    return $this->response->withJson($cards);
});

// get all playCards
$app->get('/playcards', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM playCards ORDER BY id");
    $sth->execute();
    $cards = $sth->fetchAll();

    return $this->response->withJson($cards);
});