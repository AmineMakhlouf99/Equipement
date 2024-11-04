    
    function handleCheckboxChange(event) {
        if (event.target.checked) {
            console.log('Checkbox is checked.');
        } else {
            console.log('Checkbox is unchecked.');
        }
    }
     document.getElementById('reg-log').addEventListener('change', handleCheckboxChan);