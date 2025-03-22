import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


var channal = Echo.private(`App.models.User.${userID}`);
channal.notification(function ($data){
    console.log(data);
    alert(data.body);
});
