extends Label

var gameRunning = false
var gameStarted
var time
var ms = 0
var s = 0
var m = 0

func _process(delta):
	if gameRunning :
		time = OS.get_ticks_msec() - gameStarted
		m = time / 60000
		s = time / 1000 - m*60
		ms = time % 1000
		text = "%02d:%02d:%03d" % [m,s,ms]

func _on_Valeur_visibility_changed():
	if gameStarted == null :
		gameStarted = OS.get_ticks_msec()
	gameRunning = true if visible else false
