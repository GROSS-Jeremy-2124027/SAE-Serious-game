extends Panel

var style = StyleBoxFlat.new()
var bg = Color(0,0,0,255)
var border = Color(255,255,255,255)

func _ready():
	# The Panel doc tells you which style names there are
	add_stylebox_override("panel", style)
	style.border_width_left = 5
	style.border_width_right = 5
	style.border_width_bottom = 5
	style.border_width_top = 5
	set_process(true)

func _process(delta):
	# Some basic code animation
	style.set_bg_color(bg)
	style.border_color = border
	style
	# Don't forget to update so the control will redraw
	update()
