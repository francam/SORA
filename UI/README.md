# SORA
Smart Object Recognition Architecture

This is the User Interface Module

## Running the Application.

1) Download and Install XAMPP: https://www.apachefriends.org/download.html
2) Run the Apache Web Server.
3) Download this code into the htdocs folder.
4) On FIREFOX browser, open http://localhost/ui/index.php

## Setting up video transmission

For this operation to happen, you will need to install Gstreamer on host computer. More information on how to install it here: https://gstreamer.freedesktop.org/documentation/installing/index.html

After installing Gstreamer, run the following command:

gst-launch-1.0 udpsrc port=5000 ! application/x-rtp,encoding-name=VP8 ! rtpvp8depay ! webmmux streamable=true ! queue ! tcpserversink host=localhost port=8080

