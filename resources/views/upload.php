<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $audioData = file_get_contents('php://input');
    $audioFile = 'recordings/' . uniqid() . '.wav';

    if (file_put_contents($audioFile, $audioData)) {
        $response = ['audioUrl' => $audioFile];
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Failed to save audio']);
    }
}
