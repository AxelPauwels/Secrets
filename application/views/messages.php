<script>
    var button_encrypt;
    var button_decrypt;
    var button_reset;
    var input_message;
    var input_key;
    var formIsValid;
    var formIsLocked;


    function initForm() {
        formIsLocked = false;

        //get formelements
        button_encrypt = $("#encrypt");
        button_decrypt = $("#decrypt");
        button_reset = $("#reset");
        input_message = $("#message");
        input_key = $("#key");

        //set default values
        formIsLocked = false;
        formIsValid = false;
        input_message.val('');
        input_key.val('');

        //set default settings
        disableButtons();
    }

    function formInputListener() {
        if (input_message.val() === "" || input_key.val() === "") {
            formIsValid = false;
            disableButtons();
        } else {
            formIsValid = true;
            enableButtons();
        }
    }

    function convertMessage(convertMethod, key, message) {
        $.ajax({
            type: "POST",
            url: site_url + "/messages/ajaxConvertMessage",
            data: {
                convertMethod: convertMethod,
                key: key,
                message: message
            },
            success: function (result) {
                $("#message").val(result);
                if(result == ""){
                    input_message.val('Invalid Encryption-key');
                }
                disableButtons();
                formIsLocked = true;
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX \n\n 'encryptMessage()' --\n\n" + xhr.responseText);
            }
        });
    }

    function getFromdata() {
        //default data
        $formdata = [];
        $formIsValid = false;
        $message = "";
        $key = "";

        //formdata opalen
        $formIsValid = formIsValid;
        $message = input_message.val();
        $key = input_key.val();

        //formdata returnen
        $formdata['formIsValid'] = $formIsValid;
        $formdata['message'] = $message;
        $formdata['key'] = $key;
        return $formdata;
    }

    function disableButtons() {
        button_encrypt.attr('disabled', 'disabled');
        button_decrypt.attr('disabled', 'disabled');
    }

    function enableButtons() {
        if(!formIsLocked){
            button_encrypt.removeAttr('disabled');
            button_decrypt.removeAttr('disabled');
        }
    }

    $(document).ready(function () {
        initForm();

        input_message.add(input_key).keyup(function (e) {
            formInputListener();
        });

        button_reset.click(function () {
            formIsLocked = false;
            initForm();
        });

        $(".convertButton").click(function (e) {
            e.preventDefault();
            $convertMethod = this.id;
            $formdata = getFromdata();

            if ($formdata['formIsValid']) {
                convertMessage($convertMethod, $formdata['key'], $formdata['message'],)
            }
        });
    })
    ;
</script>

<div>
    <?php
    echo form_open("a/b");

    echo div();
    echo form_textarea(array(
            'name' => 'message',
            'id' => 'message',
            'value' => $message,
            'height' => '75%',
            'class' => 'form-control',
            'placeholder' => 'Message...',
        )) . "\n";
    echo '</div>';
    echo divClose();

    echo div();
    echo form_input(array(
            'name' => 'key',
            'id' => 'key',
            'size' => '30',
            'value' => '',
            'class' => 'form-control',
            'placeholder' => "Encryption-key...",
        )) . "\n";
    ?>

    <button type="submit" id="encrypt" name="encrypt" class="btn btn-danger size convertButton">
        <i class="fa fa-lock"></i> Encrypt
    </button>
    <button type="submit" id="decrypt" name="decrypt" class="btn btn-success size convertButton">
        <i class="fa fa-unlock"></i> Decrypt
    </button>

    <?php
    $data_submit_resetform = array(
        'type' => 'button',
        'id' => 'reset',
        'name' => 'reset',
        'value' => 'Reset form',
        'class' => 'btn btn-default size convertButton',
        'style' => 'height:35px;margin-top:9px'
    );
    echo form_submit($data_submit_resetform) . "\n";
    echo divClose();

    echo form_close();

    ?>
</div>
