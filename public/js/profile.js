
$(document).ready(function () 
{
    $('#myfrm').validate ({
            //specify the valiadtion rules
            rules: 
            {
                        
                photo: 
                {
                    required: true,
                    accept: 'image'                           
                },
                hobbies: 
                {
                    required: true
                },
                contact_no: 
                {
                    required: true,
                    minlength: 10,
                    maxlength: 12
                },
                education: 
                {
                    depends: function(element) 
                    {
           				return $("#edu").val() == "select";
           			}
                },
                experience: 
                {
                    required: true
                },
                location: 
                {
                    depends: function(element) 
                    {
           				return $("#loc").val() == "select";
        			}
                },
                desc: 
                {
                    required: true,
                    minlength: 10,
                    maxlength: 20
                }
            },
            //specify the  validation message
            messages: 
            {
                            
                photo: 
                {
                    required: 'plz upload image '                   
                },
                hobbies: 
                { 
                    required: 'plz write hobbies'
                },
                contact_no: 
                {
                    required: 'enter a contact no',
                    minlength: 'your length is too short',
                    maxlength: 'your length is too long'
                },
                education: 
                {
                    requiurd: 'select education'
                },
                experience: 
                {
                    required: 'plz enter experience'
                },
                location: 
                {
                    required: 'plz select location'
                }
                desc: 
                {
                    required: 'plz enter desc',
                    minlength: 'your length is too short',
                    maxlength: 'your length is too long'
                }     
            }
            submitHandler: function(form) 
            {
            form.submit();
            }
    });
});
