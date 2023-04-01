extends Area2D


func _on_Home_input_event(viewport, event, shape_idx):
	Input.set_default_cursor_shape(Input.CURSOR_POINTING_HAND)
	if event is InputEventMouseButton:
		if event.is_pressed():
			JavaScript.eval("window.location.href='../'")

func _on_Home_mouse_exited():
	Input.set_default_cursor_shape(Input.CURSOR_ARROW)
