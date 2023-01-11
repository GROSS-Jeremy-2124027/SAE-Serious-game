extends ColorRect

var BLACK = Color(0,0,0)
var WHITE = Color('ffffff')

func _on_Sombre_visibility_changed():
	for i in range(0,get_child_count()):
		for j in range (0,get_child(i).get_child_count()):
			get_child(i).get_child(j).get_child(0).get_node("Panel").bg = BLACK
			get_child(i).get_child(j).get_child(0).get_node("Panel").border = WHITE
			get_child(i).get_child(j).get_child(0).get_node("MarginContainer/HBoxContainer/Label").add_color_override("font_color", WHITE)

func _on_box_resized():
	yield(get_tree(), "idle_frame")
	for i in range(0,get_child_count()):
		for j in range (0,get_child(i).get_child_count()):
			get_child(i).get_child(j).get_node("CollisionMouse").shape.set("extents", get_child(i).get_child(j).get_node("box").rect_size/2)
			get_child(i).get_child(j).get_node("CollisionMouse").position = get_child(i).get_child(j).get_node("box").rect_size/2
