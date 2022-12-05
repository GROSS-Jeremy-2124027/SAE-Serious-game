extends ColorRect

var BLACK = Color(0,0,0)
# Declare member variables here. Examples:
# var a = 2
# var b = "text"


# Called when the node enters the scene tree for the first time.
func _ready():
	pass # Replace with function body.


# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#	pass


func _on_Sombre_visibility_changed():
	if (visible):
		for i in get_child_count():
			get_child(i).get_node("ColorRect").color = BLACK
