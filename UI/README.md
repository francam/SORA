# SORA
Smart Object Recognition Architecture

This is the User Interface Module.

## Running the Application.

1) Download and Install XAMPP: https://www.apachefriends.org/download.html
2) Run the Apache Web Server.
3) Download this code into the htdocs folder.
4) On FIREFOX browser, open http://localhost/ui/index.php

## Testing the video feed transmission

While the Java Server performs these operations. The following commands will help in verifying the individual video feed transmissions.

For this operation to happen, you will need to install Gstreamer on the JETSON and on the host computer. More information on how to install it here: https://gstreamer.freedesktop.org/documentation/installing/index.html

Additionally, install YOLO on the Jetson. More information found here: https://pjreddie.com/darknet/yolo/

**On the JETSON run**:

For RAW footage:

gst-launch-1.0 v4l2src device=/dev/video1 ! video/x-raw, width=3840, height=1080, framerate=30/1 ! videocrop top=0 left=0 right=1920 bottom=0 ! videoconvert ! videoscale ! video/x-raw, width=480, height=240, format=I420 ! clockoverlay shaded-background=true font-desc="Sans 24" ! vp8enc target-bitrate=2500000 ! tee name=branch ! queue ! rtvpvp8pay ! udpsink host=*IP-ADDRESS* port=5000 branch. ! queue ! matroskamux ! filesink location=mkvTesting.mkv

For Annotaded footage 
  
gst-launch-1.0  ximagesrc xname="ZED" use-damage=0 ! videoconvert ! videoscale ! video/x-raw,width=480,height=240,format=I420 ! clockoverlay shaded-background=true font-desc="Sans 24" ! vp8enc target-bitrate=2500000 ! rtvpvp8pay ! udpsink host=*IP-ADDRESS* port=5000
  
  *Please Replace the part in italic with the IP address of the machine*

**On the host computer where the Apache Server is running, run:**

gst-launch-1.0 udpsrc port=5000 ! application/x-rtp,encoding-name=VP8 ! rtpvp8depay ! webmmux streamable=true ! queue ! tcpserversink host=localhost port=8080
