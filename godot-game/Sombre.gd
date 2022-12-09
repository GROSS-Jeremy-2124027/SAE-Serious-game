extends ColorRect

var BLACK = Color(0,0,0)
var completed = false

func _on_Sombre_visibility_changed():
	if (!visible and !completed):
		for i in get_child_count():
			get_child(i).get_node("ColorRect").color = BLACK
