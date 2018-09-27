<script>
$('#submit').click(function(){
//validate form
 $.get('sample-action.php',$('#sample-form').serialize(),function(response){
  $('#result').html(response);
 });
});
</script>