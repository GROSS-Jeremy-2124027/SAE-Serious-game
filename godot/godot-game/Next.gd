extends Area2D


func _on_Next_input_event(viewport, event, shape_idx):
	Input.set_default_cursor_shape(Input.CURSOR_POINTING_HAND)
	if event is InputEventMouseButton:
		if event.is_pressed():
			var actualLevel = int(get_parent().get_parent().get_parent().name[-1])
			if actualLevel < 4 :
				JavaScript.eval("window.location.href='../level-"+String(actualLevel+1)+"/'")
			else :
				JavaScript.eval("window.location.href='../'")

func _on_Next_mouse_exited():
	Input.set_default_cursor_shape(Input.CURSOR_ARROW)
