<?php
// Routes

// get all playCards
$app->get('/placeholercards', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM cardHolders ORDER BY id");
    $sth->execute();
    $cards = $sth->fetchAll();
    return $this->response->withJson($cards);

    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
});