extends Area2D

var BLACK = Color(0,0,0)
var RED = Color(255,0,0)
var GREEN = Color(0,255,0)
var BLUE = Color(0,80,255)
enum colors {BLACK,RED,GREEN,BLUE}
var color = colors.BLACK
	
func _on_MonoArea2D_input_event(viewport, event, shape_idx):
	Input.set_default_cursor_shape(Input.CURSOR_POINTING_HAND)
	if event is InputEventMouseButton:
		if event.is_pressed():
			set_current_color()
			var multiColor = get_parent().get_node("MultiArea2D/ColorRect").color
			var diffuColor = get_parent().get_node("DiffuArea2D/ColorRect").color
			next_color()
			while (get_node("ColorRect").visible and (get_node("ColorRect").color == multiColor or get_node("ColorRect").color == diffuColor)):
				next_color()

func _on_MonoArea2D_mouse_exited():
	Input.set_default_cursor_shape(Input.CURSOR_ARROW)

func set_current_color():
	match get_node("ColorRect").color:
		BLACK:
			color = colors.BLACK
		RED:
			color = colors.RED
		GREEN:
			color = colors.GREEN
		BLUE:
			color = colors.BLUE

func next_color():
	if color < 3:
		color += 1
	else :
		color = 0
	match color:
		colors.BLACK:
			get_node("ColorRect").color = BLACK
			get_node("ColorRect").visible = false
		colors.RED:
			get_node("ColorRect").color = RED
			get_child(2).visible = true
		colors.GREEN:
			get_node("ColorRect").color = GREEN
			get_child(2).visible = true
		colors.BLUE:
			get_node("ColorRect").color = BLUE
			get_child(2).visible = true
