document.addEventListener('DOMContentLoaded', function() {
    if (! location.pathname.match(/admin\/article\/(edit\/.+|add)/)) {
      return;
    }

    let colors = ['#e60000', '#ff9900', '#ffff00', '#008a00', '#0066cc', 
      '#9933ff', '#ffffff', '#facccc', '#ffebcc', '#ffffcc', 
      '#cce8cc', '#cce0f5', '#ebd6ff', '#bbbbbb', '#f06666', 
      '#ffc266', '#ffff66', '#66b966', '#66a3e0', '#c285ff', 
      '#888888', '#a10000', '#b26b00', '#b2b200', '#006100', 
      '#0047b2', '#6b24b2', '#444444', '#5c0000', '#663d00', 
      '#666600', '#003700', '#002966', '#3d1466', '#6d6d6d'];

    let quill = new Quill('.form__editor', {
        theme: 'snow',
         modules: {
            imageResize: {
              displaySize: true
            },
           syntax: true,
           toolbar: [
             [{'header': 1}, 'bold', { 'color': colors }, {'background': []}],
             [{ 'align': [] }, {'list': 'ordered'}, {'list': 'bullet'}],
             ['link', 'image', 'code-block'],
           ]
        }
    });

    document.querySelector('.article__form').onsubmit = () => {
        document.querySelector('[name="content"]').value = quill.root.innerHTML;
    };
});