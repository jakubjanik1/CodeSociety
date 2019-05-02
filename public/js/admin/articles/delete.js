document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function() {
        let confirm = document.querySelector('.confirm');
        if (confirm && !event.target.closest('button.cell__link, .confirm')) {
            confirm.remove();
        }
   });

   let deleteLinks = document.querySelectorAll('button.cell__link');
   deleteLinks.forEach(deleteLink => {
        deleteLink.addEventListener('click', function() {
            let confirm = document.querySelector('.confirm');
            if (confirm) {
                confirm.remove();
            }

            showConfirmBox(this);
        });
   });
});

function showConfirmBox(link) {
    let confirmBox = document.createElement('div');
    confirmBox.classList.add('confirm');

    let message = document.createElement('div');
    message.innerText = 'Are you sure?';
    message.classList.add('confirm__message');

    let deleteLink = document.createElement('a');
    deleteLink.innerText = 'Delete';
    deleteLink.href = link.getAttribute('href');
    deleteLink.classList.add('confirm__button', 'confirm__button--delete');

    let cancelLink = document.createElement('button');
    cancelLink.innerText = 'Cancel';
    cancelLink.classList.add('confirm__button', 'confirm__button--cancel');
    cancelLink.onclick = () => confirmBox.remove();


    confirmBox.append(message, deleteLink, cancelLink);
    link.parentElement.append(confirmBox);
}