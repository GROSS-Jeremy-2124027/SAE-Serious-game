extends StaticBody2D

var BLACK = Color(0,0,0)
var WHITE = Color('ffffff')
var RED = Color('c80000')
var time = 0
var correct = false
var wait_time = 3
var idReponse
var ready = false
var wrong = 0
var wait_time_wrong = 3
var wait_time_wrong2 = 3

func _process(delta):
	if (ready):
		if (get_parent().get_node("KinematicBody2D").pcid >= int(name[-1])):
			get_node("PCsprite").texture = load("res://ASSETS/Billboard and Advertising/2 Billboard/64x64_2.png")
			get_node("PCshape").disabled = false
		if (get_parent().get_node("CanvasLayer/Sombre/Q1/R" + String(idReponse) + "/box/Panel").bg == WHITE) :
			correct = true
			wrong = 0
		else :
			correct = false
		for id in range(4):
			if id+1 != idReponse :
				if (get_parent().get_node("CanvasLayer/Sombre/Q1/R" + String(id+1) + "/box/Panel").bg == WHITE) :
					if wrong != id+1 :
						wait_time_wrong = 3
						wrong = id+1
		if (correct):
			if (1 > wait_time) :
				reinit_for_next_pc()
			else :
				wait_time-=delta
		else :
			wait_time = 3
		if (wrong > 0) : # si réponse incorrect sélectionné
			incorrect_answer(delta)

func incorrect_answer(delta) :
	# ceci est un code dont je ne veux pas parler
	if (1 > wait_time_wrong) : # si réponse incorrect confirmé
		if get_parent().get_node("CanvasLayer/Sombre").mouse_filter != 0 :
			for id in range(4):
				if (get_parent().get_node("CanvasLayer/Sombre/Q1/R" + String(id+1) + "/box/Panel").bg == WHITE) :
					get_parent().get_node("CanvasLayer/Sombre/Q1/R" + String(id+1) + "/box/Panel").bg = RED
			get_parent().get_node("CanvasLayer/Sombre").mouse_filter = 0
		elif 1 > wait_time_wrong2 :
			get_parent().get_node("CanvasLayer/Sombre").visible = false
			wrong = 0
			wait_time_wrong2 = 3
			get_parent().nbErrors += 1
			get_parent().get_node("CanvasLayer/Sombre").mouse_filter = 2
			
		else :
			wait_time_wrong2-=delta
	else :
		wait_time_wrong-=delta
	
func reinit_for_next_pc() :
	get_parent().get_node("CanvasLayer/ChatBox").rect_position.x = 11
	get_parent().get_node("KinematicBody2D").state = get_parent().get_node("KinematicBody2D").States.FLOOR
	get_node("check").visible = true
	get_parent().get_node("CanvasLayer/Sombre").visible = false
	get_node("PCshape").disabled = true
	get_parent().get_node("KinematicBody2D").pcid += 1
	ready = false
	get_parent().set_next_pc()
