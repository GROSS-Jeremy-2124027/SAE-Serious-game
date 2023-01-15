extends StaticBody2D

var BLACK = Color(0,0,0)
var RED = Color("b92b2b")
var GREEN = Color("1e982e")
var BLUE = Color("2b45b9")
var time = 0
var correct = false
var completed = false
var wait_time = 3
var noBlack = false

func _process(delta):
	if (!completed):
		if (get_parent().get_node("KinematicBody2D").pcid >= int(name[-1])):
			get_node("PCsprite").texture = load("res://ASSETS/Billboard and Advertising/2 Billboard/64x64_2.png")
			get_node("PCshape").disabled = false
		noBlack = true
		for i in get_node("Sombre").get_child_count():
			if (get_node("Sombre").get_child(i).get_node("ColorRect").color == BLACK):
				noBlack = false
				correct = false
		if noBlack:
			if (get_node("Sombre/Q1/ColorRect").color == get_node("Sombre/R2/ColorRect").color):
				if (get_node("Sombre/Q2/ColorRect").color == get_node("Sombre/R3/ColorRect").color):
					if (get_node("Sombre/Q3/ColorRect").color == get_node("Sombre/R1/ColorRect").color):
						correct = true
		if (correct):
			if (1 > wait_time) :
				get_parent().get_node("KinematicBody2D").state = get_parent().get_node("KinematicBody2D").States.FLOOR
				for i in range(0,get_node("Sombre").get_child_count()):
					get_node("Sombre").get_child(i).set_block_signals(true)
				get_node("Sombre").completed = true
				completed = true
				get_node("check").visible = true
				get_node("Sombre").visible = false
				get_node("PCshape").disabled = true
				get_parent().get_node("KinematicBody2D").pcid += 1
			else :
				wait_time-=delta
		else :
			wait_time = 3
		
