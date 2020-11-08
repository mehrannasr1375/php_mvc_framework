document.addEventListener('DOMContentLoaded', () => {

    // scalable-input
    document.querySelectorAll('.scalable-input').forEach( (item, index) => {
        if (item.value == '')
            item.classList.remove('has-val');
        else
            item.classList.add('has-val');

        item.addEventListener('change', () => {
            if (item.value == '')
                item.classList.remove('has-val');
            else
                item.classList.add('has-val');
        })
    });

        
})
