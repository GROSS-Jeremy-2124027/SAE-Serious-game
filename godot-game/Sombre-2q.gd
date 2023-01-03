extends ColorRect

var BLACK = Color(0,0,0)
var WHITE = Color('ffffff')
var completed = false

func _on_Sombre_visibility_changed():
	if (!visible and !completed):
		for i in range(0,get_child_count()):
			for j in range (0,get_child(i).get_child_count()):
				print(get_child(i).get_child(j).get_child(0).get_node("Panel").bg)
				get_child(i).get_child(j).get_child(0).get_node("Panel").bg = BLACK
				get_child(i).get_child(j).get_child(0).get_node("Panel").border = WHITE
				get_child(i).get_child(j).get_child(0).get_node("MarginContainer/HBoxContainer/Label").add_color_override("font_color", WHITE)
