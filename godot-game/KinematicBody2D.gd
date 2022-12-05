extends KinematicBody2D

var SPEED = 600
var LADDER_SPEED = SPEED/2
var ANTI_SLIPPERY = 0.3 # pourcentage
var MAX_JUMP_TIME = 20 # en frame
var GRAVITY_FORCE = 70
var MAX_GRAVITY_FORCE = 2000
var JUMP_FORCE = 1100

enum States {AIR = 1, FLOOR, LADDER, PC}
var state = States.AIR
var jumpTime = 0
var jumpTopLadderTime = 0
var velocity = Vector2(0,0)
var jumping := false
var jumpingTopLadder := false
var onLadder := false
var onPc := false

func _physics_process(delta):
	match state:
		States.AIR:
			if is_on_floor():
				state = States.FLOOR
			elif should_climb_ladder():
				state = States.LADDER
			$Sprite.play("Air")
			if Input.is_action_pressed("ui_left"):
				$Sprite.flip_h=true
				velocity.x = lerp(velocity.x,-SPEED,ANTI_SLIPPERY)
			elif Input.is_action_pressed("ui_right"):
				$Sprite.flip_h=false
				velocity.x = lerp(velocity.x,SPEED,ANTI_SLIPPERY)
			else:
				velocity.x = lerp(velocity.x,0,ANTI_SLIPPERY)
			if jumping and Input.is_action_pressed("ui_up") and jumpTime < MAX_JUMP_TIME:
				jumpTime+=1
				velocity.y += GRAVITY_FORCE/5
			else:
				jumping = false
				jumpTime = 0
			if jumpingTopLadder and jumpTopLadderTime < MAX_JUMP_TIME :
				jumpTopLadderTime+=1
				velocity.y += GRAVITY_FORCE/5
			else:
				jumpingTopLadder = false
				jumpTopLadderTime = 0
			move_and_fall()
		States.FLOOR:
			if not is_on_floor():
				state = States.AIR
			elif should_use_pc():
				state = States.PC
			elif should_climb_ladder():
				state = States.LADDER
			if Input.is_action_pressed("ui_up"):
				if should_climb_ladder():
					state = States.LADDER
					continue
				jumping = true
				velocity.y = -JUMP_FORCE
				state=States.AIR
			if Input.is_action_pressed("ui_left"):
				$Sprite.flip_h=true
				$Sprite.play("Walk")
				velocity.x = lerp(velocity.x,-SPEED,ANTI_SLIPPERY)
			elif Input.is_action_pressed("ui_right"):
				$Sprite.flip_h=false
				$Sprite.play("Walk")
				velocity.x = lerp(velocity.x,SPEED,ANTI_SLIPPERY)
			else :
				velocity.x = lerp(velocity.x,0,ANTI_SLIPPERY)
				$Sprite.play("Idle")
			move_and_fall()
		States.LADDER:
			if not onLadder:
				if (Input.is_action_pressed("ui_up")):
					jumpingTopLadder = true
					velocity.y = -1000
				state=States.AIR
				continue
			elif is_on_floor() and Input.is_action_pressed("ui_down"):
				Input.action_release("ui_down")
				state=States.FLOOR
				continue
			if (Input.is_action_pressed("ui_up") or Input.is_action_pressed("ui_down") or Input.is_action_pressed("ui_left") or Input.is_action_pressed("ui_right")):
				$Sprite.play("Climb")
			else:
				$Sprite.stop()
			if (Input.is_action_pressed("ui_up")):
				velocity.y = -LADDER_SPEED
			elif (Input.is_action_pressed("ui_down")):
				velocity.y = LADDER_SPEED
			else:
				velocity.y = 0
			if (Input.is_action_pressed("ui_left")):
				velocity.x = -LADDER_SPEED/2
			elif (Input.is_action_pressed("ui_right")):
				velocity.x = LADDER_SPEED/2
			else:
				velocity.x = 0
			velocity = move_and_slide(velocity, Vector2.UP)
		States.PC:
			$Sprite.play("Watch")
			get_parent().get_node("PC/Sombre").set("visible", true)
			if (Input.is_action_just_pressed("ui_select")):
				get_parent().get_node("PC/Sombre").set("visible", false)
				state = States.FLOOR

func should_climb_ladder() -> bool:
	if onLadder and (Input.is_action_pressed("ui_up") or Input.is_action_pressed("ui_down")):
		return true
	else:
		return false

func should_use_pc() -> bool:
	if onPc and Input.is_action_just_pressed("ui_select"):
		return true
	else:
		return false

func move_and_fall():
	if velocity.y < MAX_GRAVITY_FORCE and not jumping:
		velocity.y += GRAVITY_FORCE
	velocity = move_and_slide(velocity,Vector2.UP)

func resetPC():
	get_parent().get_node("PC/ColorRect/DiffuArea2D/ColorRect").color

func _on_LadderChecker_body_entered(body):
	onLadder = true

func _on_LadderChecker_body_exited(body):
	onLadder = false

func _on_LadderChecker2_body_entered(body):
	onPc = true

func _on_LadderChecker2_body_exited(body):
	onPc = false


