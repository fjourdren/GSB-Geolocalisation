package com.gsb.ppe.geolocalisation;

import android.Manifest;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.os.Build;
import android.support.v4.content.ContextCompat;
import android.content.pm.PackageManager;
import android.content.Intent;

public class GeoLocalisation extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_geo_localisation);

        runtimePermission();

        Intent i = new Intent(getApplicationContext(), GeoLocalisation_service.class);
        startService(i);
    }

    private boolean runtimePermission() {
        if(Build.VERSION.SDK_INT >= 23
                && ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
                && ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED
                && ContextCompat.checkSelfPermission(this, Manifest.permission.READ_PHONE_STATE) != PackageManager.PERMISSION_GRANTED){

            requestPermissions(new String[]{Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION},100);

            return true;
        }
        return false;
    }
}
