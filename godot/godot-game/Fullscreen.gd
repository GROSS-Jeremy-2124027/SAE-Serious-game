extends TouchScreenButton

func _on_Fullscreen_pressed():
	OS.window_fullscreen = !OS.window_fullscreen
