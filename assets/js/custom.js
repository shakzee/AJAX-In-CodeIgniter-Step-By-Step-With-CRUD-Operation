
$(document).ready(function(){
    $('.mysubmit').click(function(){
      var name =   $('.name').val();
        var email =  $('.email').val();
        var password =  $('.password').val();
        if(name == "" || email == "" || password == ""){
            $('.feedback').text('All fields are required..');
        }
        else{
            console.log();
            $.ajax({
                type:'POST',
                url:srul+"crud/addUser",
                data:{
                    name:name,
                    email:email,
                    password:password
                },
                success:function($data){
                    var myvar = "";
                    var conv = JSON.parse($data);
                        myvar+='<tr class="tr'+conv.stId+'">';
                            myvar+='<td class="dyId'+conv.stId+'">'+conv.stId+'</td>';
                            myvar+='<td class="dyName'+conv.stId+'">'+conv.stName+'</td>';
                            myvar+='<td class="dyemail'+conv.stId+'">'+conv.stEmail+'</td>';
                            myvar+='<td>'+conv.stDate+'</td>';

                            myvar+='<td>';
                                myvar+='<a href="javascript:void(0)" data-text="'+conv.enId+'" data-id="'+conv.stId+'" class="edit">';
                                    myvar+='Edit';
                                myvar+='</a>';
                            myvar+='</td>';

                            myvar+='<td>';
                                myvar+='<a href="javascript:void(0)" data-text="'+conv.enId+'" data-id="'+conv.stId+'" class="delete">';
                                    myvar+='Delete';
                                myvar+='</a>';
                            myvar+='</td>';

                        myvar+='</tr>';
                    $('.mytable').append(myvar);
                    console.log(conv);
                    //feedback here.
                },
                error:function(){
                    //error here
                }
            })//
        }

    });


    $('.edit').click(function(){
        var text =  $(this).data('text');
        var id =  $(this).data('id');
        $.ajax({
            type:'post',
            url:srul+'crud/checkUser',
            data:{
                text:text,
                id:id
            },
            success:function($response){
                var dyfield =  "";
                var obj = JSON.parse($response);
                dyfield+='<input type="text" class="dyName" value="'+obj[0].stName+'">';
                dyfield+='<input type="text" class="dyEmail" value="'+obj[0].stEmail+'">';
                dyfield+='<input type="text" class="dyPassword" value="'+obj[0].stPassword+'">';
                dyfield+='<button data-id="'+obj[0].stId+'" class="updybut">Update</button>';
                $('.dycondiv').html(dyfield);

            },
            error:function(){
                console.log('print the error here')
            }

        })



    });
    $('body').on('click','.updybut',function () {
        var dyName = $('.dyName').val();
        var dyEmail = $('.dyEmail').val();
        var dyPassword = $('.dyPassword').val();
        var id = $(this).data('id') ;
         if(dyEmail == "" || dyName == "" || dyPassword == "" || id == ""){
            $('.feedback').text('please check the required field and try again');
        }
        else{
             $.ajax({
                 type:'post',
                 url:srul+'crud/update',
                 data: {
                    dyName:dyName,
                     dyEmail:dyEmail,
                     dyPassword:dyPassword,
                     id:id
                 },
                 success:function ($myreqpo) {
                    if ($myreqpo){
                        $('.dyName'+id).text(dyName);
                        $('.dyEmail'+id).text(dyName);
                        $('.dycondiv').empty();
                    }
                    else{
                        $('.feedback').text('We can\'t update your record right now.');
                    }
                 },
                 error:function () {
                     console.log('error here..');
                 }
             })
        }
    });
    $('body').on('click','.delete',function () {
       var text =  $(this).data('text');
        var id =  $(this).data('id');

        if(text == "" || id == ""){
            $('.feedback').text('please check the required field and try again');
        }
        else{
            $.ajax({
                type:'post',
                url:srul+'crud/delete',
                data:{
                    text:text
                },
                success:function ($response) {
                   if($response == true){
                       $('.feedback').text('You have successfully deleted.');
                       $('.tr'+id).fadeOut('slow');
                   }
                   else{
                       $('.feedback').text('You can\'t delete your section right now.');
                   }
                },
                error:function () {

                }
            })
        }
    });
});//ready section

