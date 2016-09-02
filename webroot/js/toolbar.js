function cm_toolbar(editor, name) {
  var editorToolbar = '<div class="row">'
      + '    <div class="col-sm-12">'
      + '        <div class="toolbar">'
      + '            <div class="btn-group">'
      + '                <a>Headers:<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Header 1" onClick="cm_insert(' + name + ', \'h1\')">#1<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Header 2" onClick="cm_insert(' + name + ', \'h2\')">#2<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Header 3" onClick="cm_insert(' + name + ', \'h3\')">#3<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Header 4" onClick="cm_insert(' + name + ', \'h4\')">#4<\/a>'
      + '            <\/div>'
      + '            <div class="btn-group">'
      + '                <a>Style:<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Bold" onClick="cm_insert(' + name + ', \'bold\')"><i class="fa fa-bold fa-fw" title="Bold"><\/i><\/a>'
      + '                <a class="btn btn-default btn-lg" title="Italic" onClick="cm_insert(' + name + ', \'italic\')"><i class="fa fa-italic fa-fw" title="Italic"><\/i><\/a>'
      + '            <\/div>'
      + '            <div class="btn-group">'
      + '                <a>Misc:<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Link" onClick="cm_insert(' + name + ', \'link\')"><i class="fa fa-link fa-fw" title="Link"><\/i><\/a>'
      + '                <a class="btn btn-default btn-lg" title="Picture" onClick="cm_insert(' + name + ', \'picture\')"><i class="fa fa-picture-o fa-fw" title="Picture"><\/i><\/a>'
      + '                <a class="btn btn-default btn-lg" title="Inline code" onClick="cm_insert(' + name + ', \'inline_code\')"><i class="fa fa-code fa-fw" title="Inline code"><\/i><\/a>'
      + '            <\/div>'
      + '            <div class="btn-group">'
      + '                <a>Blocks:<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Quote block" onClick="cm_insert(' + name + ', \'block_quote\')"><i class="fa fa-quote-right fa-fw" title="Quote"><\/i><\/a>'
      + '                <a class="btn btn-default btn-lg" title="Code block" onClick="cm_insert(' + name + ', \'code_block\')"><i class="fa fa-code fa-fw" title="Code block"><\/i><\/a>'
      + '            <\/div>'
      + '            <div class="btn-group">'
      + '                <a>Preview:<\/a>'
      + '                <a class="btn btn-default btn-lg" title="Preview the current text" onClick="cm_preview(' + name + ')"><i class="fa fa-quote-right fa-fw" title="Quote"><\/i><\/a>'
      + '            <\/div>'
      + '        <\/div>'
      + '    <\/div>'
      + '<\/div>';

  $(editor.getWrapperElement()).prepend(editorToolbar);
}

function cm_insert(editor, type) {
  var table = {
    'h1': "\n# Title 1",
    'h2': "\n## Title 2",
    'h3': "\n### Title 3",
    'h4': "\n#### Title 4",
    'bold': ' **text** ',
    'italic': ' _text_ ',
    'link': " [title](http://) ",
    'picture': " ![alt](http:// \"Image Title\") ",
    'inline_code': " `Code` ",
    'block_quote': "\n> ",
    'code_block': "```txt\n\n```\n"
  };

  var doc = editor.getDoc();
  // gets the line number in the cursor position
  var cursor = doc.getCursor();
  // get the line contents
  var line = doc.getLine(cursor.line);
  // create a new object to avoid mutation of the original selection
  var pos = {
    line: cursor.line,
    // set the character position to the end of the line
    ch: line.length - 1
  };
  // adds a new line
  doc.replaceRange(table[type], pos);
}

function cm_preview(editor) {
  // Update preview area
  $('#previewModalContent').html(marked(editor.getValue()));
  // Update pre areas
  
  // Display modal
  $('#previewModal').modal('show');
}
