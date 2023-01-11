extends StaticBody2D

var BLACK = Color(0,0,0)
var WHITE = Color('ffffff')
var time = 0
var correct = false
var wait_time = 3
var idReponse
var ready = false

func _process(delta):
	if (ready):
		if (get_parent().get_node("KinematicBody2D").pcid >= int(name[-1])):
			get_node("PCsprite").texture = load("res://ASSETS/Billboard and Advertising/2 Billboard/64x64_2.png")
			get_node("PCshape").disabled = false
		if (get_parent().get_node("CanvasLayer/Sombre/Q1/R" + String(idReponse) + "/box/Panel").bg == WHITE) :
			correct = true
		else :
			correct = false
		if (correct):
			if (1 > wait_time) :
				reinit_for_next_pc()
			else :
				wait_time-=delta
		else :
			wait_time = 3

func reinit_for_next_pc() :
	get_parent().get_node("KinematicBody2D").state = get_parent().get_node("KinematicBody2D").States.FLOOR
	get_node("check").visible = true
	get_parent().get_node("CanvasLayer/Sombre").visible = false
	get_node("PCshape").disabled = true
	get_parent().get_node("KinematicBody2D").pcid += 1
	ready = false
	get_parent().set_next_pc()
