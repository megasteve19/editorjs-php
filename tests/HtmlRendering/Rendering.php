<?php

$editorJS = new \Megasteve19\EditorJS\EditorJS($sampleData, $config);

echo $editorJS->toHTML(__DIR__ . '/Templates');
