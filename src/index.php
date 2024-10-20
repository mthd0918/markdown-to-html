<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown to HTML Converter</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.0.2/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs/loader.min.js"></script>
    <style>
        #editor-container, #preview, #html-content {
            height: 600px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
        }
        #html-content {
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-3">
        <h1 class="text-center mb-4">Markdown to HTML Converter</h1>
        <div class="row">
            <div class="col-md-6 mb-3">
                <h2>Markdown Input</h2>
                <div id="editor-container"></div>
            </div>
            <div class="col-md-6 mb-3">
                <ul class="nav nav-tabs" id="outputTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview" type="button" role="tab" aria-controls="preview" aria-selected="true">Preview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="html-tab" data-bs-toggle="tab" data-bs-target="#html-content" type="button" role="tab" aria-controls="html-content" aria-selected="false">HTML</button>
                    </li>
                </ul>
                <div class="tab-content" id="outputTabsContent">
                        <div class="tab-pane fade show active" id="preview" role="tabpanel" aria-labelledby="preview-tab"></div>
                        <div class="tab-pane fade" id="html-content" role="tabpanel" aria-labelledby="html-tab"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            var editor = monaco.editor.create(document.getElementById('editor-container'), {
                value: '# Welcome to Markdown\n\nType your markdown here!',
                language: 'markdown',
                theme: 'vs',
                automaticLayout: true
            });
            
            function updateContent() {
                var markdown = editor.getValue();
                var html = marked.parse(markdown);
                document.getElementById('preview').innerHTML = html;
                document.getElementById('html-content').textContent = html;
                console.log('HTML Content:', html);
            }
            
            editor.onDidChangeModelContent(updateContent);
            updateContent();
        });
    </script>
</body>
</html>