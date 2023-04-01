extends Area2D

var BLACK = Color(0,0,0)
var WHITE = Color('ffffff')
	
func _on_R1_input_event(viewport, event, shape_idx):
	Input.set_default_cursor_shape(Input.CURSOR_POINTING_HAND)
	if event is InputEventMouseButton:
		if event.is_pressed():
			selected()

func selected():
	for i in range(0,get_parent().get_child_count()):
		get_parent().get_child(i).get_child(0).get_node("Panel").bg = BLACK
		get_parent().get_child(i).get_child(0).get_node("Panel").border = WHITE
		get_parent().get_child(i).get_child(0).get_node("MarginContainer/HBoxContainer/Label").add_color_override("font_color", WHITE)
	get_child(0).get_node("Panel").bg = WHITE
	get_child(0).get_node("Panel").border = BLACK
	get_child(0).get_node("MarginContainer/HBoxContainer/Label").add_color_override("font_color", BLACK)

func _on_R1_mouse_exited():
	Input.set_default_cursor_shape(Input.CURSOR_ARROW)
