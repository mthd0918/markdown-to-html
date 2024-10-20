<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown to HTML Converter</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.0.2/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs/loader.min.js"></script>
    <style>
        #editor-container, #preview {
            height: 600px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-3">
        <h1 class="text-center mb-4">Markdown to HTML Converter</h1>
        <div class="row">
            <div class="col-md-3">
                <h2>Markdown Input</h2>
                <div id="editor-container"></div>
            </div>
            <div class="col-md-3">
                <h2>Markdown Preview</h2>
                <div id="preview" class="overflow-auto"></div>
            </div>
        </div>
    </div>

    <script>
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.30.1/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            var editor = monaco.editor.create(document.getElementById('editor-container'), {
                value: '# Welcome to Markdown\n\nType your markdown here!',
                language: 'markdown',
                theme: 'vs-dark',
                automaticLayout: true
            });

            function updatePreview() {
                var markdown = editor.getValue();
                var html = marked.parse(markdown);
                document.getElementById('preview').innerHTML = html;
            }

            function updateHtmlOutput() {
                var markdown = editor.getValue();
                var html = marked(markdown);
            }

            editor.onDidChangeModelContent(updatePreview);

            setTimeout(updatePreview, 0);
        });
    </script>
</body>
</html>