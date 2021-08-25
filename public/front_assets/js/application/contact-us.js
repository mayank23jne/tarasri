$(document).ready(function(){


    var categoryTable= $('#contactUsTable').dataTable({
        "bServerSide": true,
        "bLengthChange": true,
        "pageLength": 10,
        "bProcessing": true,
        "order": [[ 0, "desc" ]],
        "sAjaxSource": BASE_URL+"/admin/contactus-list",
        "iDisplayLength": 10,
        "iDisplayStart":0,
        "ordering": false,
        "searching": false,
        "language": {
            "paginate": {
                "previous": "<",
                "next":">"
            }
        },
        'createdRow': function( row, data, dataIndex ) {
            //$(row).attr('data-id', 'someID');
            // $(row).children().addClass('pointer');
        }
    });

    $('body').on("click", "#submitContactUs", function () {
        var element = $(this);
        var enquiryUserName = $.trim($("#enquiry-username").val());
        var enquiryUserNumber = $.trim($("#enquiry-usernumber").val());
        var enquiryUserEmail = $.trim($("#enquiry-useremail").val());
        var enquiryUserMessage = $.trim($("#enquiry-usermessage").val());


        if (enquiryUserName == "" || enquiryUserName == null) {
            $("#enquiry-username").focus();
            messageDisplay("Please enter name", 1500, "error");

            return false;
        }

        if (!validateMethods.isValidName(enquiryUserName)) {
            $("#enquiry-username").focus();
            messageDisplay("Please enter valid name", 1500, "error");

            return false;
        }

        if(!validateMethods.isValidName(enquiryUserName)){
            $("#enquiry-username").focus();
            messageDisplay("Please enter valid name", 1500, "error");
            return false;

        }

        if(enquiryUserName.length < 3){
            $("#enquiry-username").focus();
            messageDisplay("Enter Valid Name containing atleast 3 Characters", 1500, "error");
            return false;
        }

        if (enquiryUserNumber == "" || enquiryUserNumber == null) {
            messageDisplay("Please enter mobile number", 1500, "error");
            $("#enquiry-usernumber").focus();
            return false;
        }
        if (!MobileExpr.test(enquiryUserNumber)) {
            messageDisplay("Please enter valid mobile number", 1500, "error");
            $("#enquiry-usernumber").focus();
            return false;
        }
        if (enquiryUserEmail == "" || enquiryUserEmail == null) {
            messageDisplay("Please enter email", 1500, "error");
            $("#enquiry-useremail").focus();
            return false;
        }

        if (!emailExpr.test(enquiryUserEmail)) {
            messageDisplay("Please enter valid email", 1500, "error");
            $("#enquiry-useremail").focus();
            return false;
        }else if(!enquiryUserEmail.match(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/))
        // /^\w+@[a-zA-Z]+?\.[a-zA-Z]{2,3}$/
        {
            messageDisplay("Enter valid email address",2000);
            $("#enquiry-useremail").focus();
            return false;
        }
        else if(enquiryUserEmail.match(/^_/g) || enquiryUserEmail.match(/^[0-9]/g)){
            messageDisplay("Enter valid email address",2000);
            $("#enquiry-useremail").focus();
            return false;
        }

        var enquiryUserMessage = $.trim($("#enquiry-usermessage").val());

        if (enquiryUserMessage == "" || enquiryUserMessage == null) {
            messageDisplay("Please enter message", 1500, "error");
            $("#enquiry-usermessage").focus();
            return false;
        }

        if(cleanString(enquiryUserMessage).length < 10){

            messageDisplay("Message must be more than 10 characters",1500,"error");
            $("#enquiry-usermessage").focus();
            return false;
        }
        element.prop("disabled",true);


        $.post(BASE_URL+"/application/contact-us",{name:enquiryUserName,mobile:enquiryUserNumber,email:enquiryUserEmail,message:enquiryUserMessage},function(response){
            element.prop("disabled",false);
            if(response.success){
                messageDisplay(response.message,2000,"success");
                setTimeout(function(){
                    window.location.reload();
                },1500)

            }else{
                messageDisplay(response.message,2000);

            }

        });
    });
});