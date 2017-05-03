@if(Session::has('success'))
    <a id="success" class="btn" onclick="showSuccessToast()" style="display: none;">Toast!</a>
    <script type="text/javascript">
        $("#success").trigger('click');
        function showSuccessToast(){
            Materialize.toast('{{Session::get("success")}}', 4000);
        }
    </script>
    @elseif(Session::has('error'))
    <a id="error" class="btn" onclick="showErrorToast()" style="display: none;">Toast!</a>
    <script type="text/javascript">
        $("#error").trigger('click');
        function showErrorToast(){
            Materialize.toast('{{Session::get("error")}}', 4000);
        }
    </script>
@endif