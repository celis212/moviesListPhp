<?php
    $pdo = new PDO('mysql:host=localhost;port=33008;dbname=misc', 'fred', 'zap');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

