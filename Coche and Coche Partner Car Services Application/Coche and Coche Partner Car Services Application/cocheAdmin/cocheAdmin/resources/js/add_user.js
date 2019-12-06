$(document).on('click', '#add-user', function(e){
    $('#add-user-modal').modal('show');
});

$(document).on('click', '#btn-addUser', function(event){
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/users/add-user',
        data: $('#user-form').serialize(),
        success : function(data) {

            if(data.errors) {
                $('form .form-group').removeClass('has-error');
                $('form .form-group').addClass('has-success');
                $('form .help-block').text('');

                if(data.errors.user_type){
                    $('#div-type').addClass('has-error');
                    $('#span-type').text(data.errors.user_type);
                }

                if(data.errors.firstname){
                    $('#div-firstname').addClass('has-error');
                    $('#span-firstname').text(data.errors.firstname);
                }

                if(data.errors.middlename){
                    $('#div-middlename').addClass('has-error');
                    $('#span-middlename').text(data.errors.middlename);
                }

                if(data.errors.lastname){
                    $('#div-lastname').addClass('has-error');
                    $('#span-lastname').text(data.errors.lastname);
                }

                if(data.errors.gender){
                    $('#div-gender').addClass('has-error');
                    $('#span-gender').text(data.errors.gender);
                }

                if(data.errors.birthdate){
                    $('#div-birthdate').addClass('has-error');
                    $('#span-birthdate').text(data.errors.birthdate);
                }

                if(data.errors.address){
                    $('#div-address').addClass('has-error');
                    $('#span-address').text(data.errors.address);
                }

                if(data.errors.contact_no){
                    $('#div-contact-no').addClass('has-error');
                    $('#span-contact-no').text(data.errors.contact_no);
                }

                if(data.errors.email){
                    $('#div-email').addClass('has-error');
                    $('#span-email').text(data.errors.email);
                }

                if(data.errors.username){
                    $('#div-username').addClass('has-error');
                    $('#span-username').text(data.errors.username);
                }

                if(data.errors.password){
                    $('#div-password').addClass('has-error');
                    $('#span-password').text(data.errors.password);
                }

                if(data.errors.password_confirmation){
                    $('#div-cpassword').addClass('has-error');
                    $('#span-cpassword').text(data.errors.password_confirmation);
                }

            }else {
                users.ajax.reload();
                $('#add-user-modal').modal('hide');
                $('#message').text(data['message']);
                $('#message-modal').modal('show');
            }
            
        }
    });
});

// Reset modal on hidden
$('#add-user-modal').on('hidden.bs.modal', function () {

    $('form .form-group').removeClass('has-error');
    $('form .form-group').removeClass('has-success');
    $('form .help-block').text('');
    $('#user-form')[0].reset();

});

   //Datemask dd/mm/yyyy
   $('#birthdate').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })