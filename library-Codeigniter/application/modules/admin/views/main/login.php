<?php
echo '<form action="'.site_url('admin/main/login').'" method="post" style="width: 650px; margin: 30px auto;">
    <table>';
        if($this->input->post('btnLogin')){
            echo '<div class="error_msg"><ul>';
        }
            echo validation_errors();
            if(isset($error)){
                echo '<li>'.$error.'</li>';
            }
        if($this->input->post('btnLogin')){
            echo '</ul></div><tr>';
        }
        echo '
            <td class="login_img"></td>
            <td>
                <span class="form_label">Username:</span>
                <span class="form_item">
                    <input type="text" name="txtUser" class="textbox" />
                </span><br />
                <span class="form_label">Password:</span>
                <span class="form_item">
                    <input type="password" name="txtPass" class="textbox" />
                </span><br />
                <span class="form_label"></span>
                <span class="form_item">
                    <input type="submit" name="btnLogin" value="Ðăng nhập" class="button" />
                </span><br />
            </td>
        </tr>
    </table>
</form>';