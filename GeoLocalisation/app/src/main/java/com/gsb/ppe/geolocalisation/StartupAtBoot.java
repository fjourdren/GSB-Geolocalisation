package com.gsb.ppe.geolocalisation;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;

public class StartupAtBoot extends BroadcastReceiver {

    @Override
    public void onReceive(Context context, Intent intent) {
        if (Intent.ACTION_BOOT_COMPLETED.equals(intent.getAction())) {
            Intent i = new Intent(context, GeoLocalisation_service.class);
            context.startService(i);
        }
    }
}
