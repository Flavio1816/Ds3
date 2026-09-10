package com.flavio.logincomshared;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class CadastroActivity extends AppCompatActivity {
    EditText nome, email, senha;

    Button voltar, cadastrar;
    CheckBox checkBox;
    SharedPreferences preferences;

    private static  final String PREF_NAME = "login";
    private static  final String KEY_EMAIL = "email";
    private  static final String KEY_NAME = "nome";
    private static final String KEY_SENHA = "senha";
    private static  final  String KEY_REMEMBER = "remember";
    SharedPreferences.Editor editor;


    @Override
    protected  void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_cadastro);

        initComponents();
        preferences = getSharedPreferences(PREF_NAME, MODE_PRIVATE);
        editor = preferences.edit();

        cadastrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if (validarCampos()) {
                    editor.putBoolean(KEY_REMEMBER, checkBox.isChecked());
                    editor.putString(KEY_EMAIL, email.getText().toString());
                    editor.putString(KEY_NAME, nome.getText().toString());
                    editor.putString(KEY_SENHA, senha.getText().toString());
                    editor.apply();

                    Intent intent = new Intent(CadastroActivity.this,
                            HomeActivity.class);
                    startActivity(intent);
                    finish();
                }
            }

        });


    }
    private boolean validarCampos() {

        boolean camposValidados = true;

        if (TextUtils.isEmpty(nome.getText().toString().trim())) {
            nome.setError("Informe o nome");
            camposValidados = false;
        }

        if (TextUtils.isEmpty(email.getText().toString().trim())) {
            email.setError("Informe o email");
            camposValidados = false;
        }

        if (TextUtils.isEmpty(senha.getText().toString().trim())) {
            senha.setError("Informe a senha");
            camposValidados = false;
        }

        return camposValidados;
    }
    private void initComponents() {
        email = findViewById(R.id.edt_email);
        senha = findViewById(R.id.edt_senha);
        nome = findViewById(R.id.edt_nome);
        voltar = findViewById(R.id.btn_voltar);
        cadastrar = findViewById(R.id.btn_cadastrar);
        checkBox = findViewById(R.id.ckb_lembrar);
    }
}
