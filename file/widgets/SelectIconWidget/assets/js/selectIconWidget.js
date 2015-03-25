$(document).ready(function(){

    nameActiveIcon = $('input[name = "File[icon]"]').val();
    $('.select-icon .fa-' + nameActiveIcon).addClass('active');

    $('.select-icon .fa').click(function(){

        elementClick = $(this);
        nameField = elementClick.attr('nameFieldForInsert');
        valueField = elementClick.attr('nameIcon');

        if(elementClick.hasClass('active')){
            elementClick.removeClass('active');

            removeValueField(nameField, valueField);
        }else{
            $('.select-icon .active').removeClass('active');
            elementClick.addClass('active');

            addValueField(nameField, valueField);
        }

    });

    function addValueField(nameField, valueField){

        $('input[name = "' + nameField + '"]').val(valueField);

    }

    function removeValueField(nameField, valueField){

        $('input[name = "' + nameField + '"]').val('');

    }


});