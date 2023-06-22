<?php
require_once 'BinarySearchTree.php';
require_once 'Node.php';

$jsonData = file_get_contents('documents.json');
$documents = json_decode($jsonData, true, 512, JSON_THROW_ON_ERROR);

$indexTree = new BinarySearchTree();

foreach ($documents as $document) {
    if (isset($document['name'])) {
        $indexTree->insert($document['name']);
    }
}

$indexData = json_encode($indexTree, JSON_PRETTY_PRINT);
file_put_contents('index.json', $indexData);

$searchTerm = 'Aachen'; // Пример искомого значения

// Поиск с использованием индекса
$searchResult = $indexTree->search($searchTerm);
if ($searchResult !== null) {
    echo 'Найденные документы: ' . $searchResult . PHP_EOL;
} else {
    echo 'Документы не найдены.' . PHP_EOL;
}

// Поиск без использования индекса (последовательный перебор)
$sequentialSearchResult = [];
$comparisonCount = 0;

foreach ($documents as $document) {
    if (isset($document['name'])) {
        $comparisonCount++;
        if ($document['name'] === $searchTerm) {
            $sequentialSearchResult[] = $document;
        }
    }
}

echo 'Найденные документы (последовательный поиск):' . PHP_EOL;
foreach ($sequentialSearchResult as $document) {
    echo 'Название: ' . $document['name'] . PHP_EOL;
    // Вывод остальных полей документа...
}

echo 'Количество операций сравнения: ' . $comparisonCount . PHP_EOL;
