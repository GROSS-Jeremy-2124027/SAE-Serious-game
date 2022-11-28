extends StaticBody2D

var inArea := false

func _physics_process(delta):
	if Input.is_action_pressed("ui_down") and inArea:
		print("oui")

func isEnteredArea(body):
	inArea = true
	print(inArea)

func isExitedArea(body):
	inArea = false
	print(inArea)
