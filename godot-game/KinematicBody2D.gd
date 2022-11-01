extends KinematicBody2D

var SPEED = 600
var ANTI_SLIPPERY = 0.3 # pourcentage
var MAX_JUMP_TIME = 20 # en frame
var GRAVITY_FORCE = 70
var MAX_GRAVITY_FORCE = 2000
var JUMP_FORCE = 1200

enum States {AIR = 1, FLOOR, LADDER, TASK}
var state = States.AIR
var jumpTime = 0
var velocity = Vector2(0,0)
var jumping := false
var onLadder := false

func _physics_process(delta):
	match state:
		States.AIR:
			if is_on_floor():
				state = States.FLOOR
				#continue
			$Sprite.play("Air")
			if Input.is_action_pressed("ui_left"):
				$Sprite.flip_h=true
				velocity.x = lerp(velocity.x,-SPEED,ANTI_SLIPPERY)
			elif Input.is_action_pressed("ui_right"):
				$Sprite.flip_h=false
				velocity.x = lerp(velocity.x,SPEED,ANTI_SLIPPERY)
			else:
				velocity.x = lerp(velocity.x,0,ANTI_SLIPPERY)
			if Input.is_action_pressed("ui_up") and jumpTime < MAX_JUMP_TIME and jumping:
				jumpTime+=1
				velocity.y += GRAVITY_FORCE/5
			else:
				jumping = false
				jumpTime = 0
			move_and_fall()
		States.FLOOR:
			if not is_on_floor():
				state=States.AIR
				#continue
			if Input.is_action_pressed("ui_up"):
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
	
func move_and_fall():
	if velocity.y < MAX_GRAVITY_FORCE and not jumping:
		velocity.y += GRAVITY_FORCE
	velocity = move_and_slide(velocity,Vector2.UP)

func _on_LadderChecker_body_entered(body):
	onLadder = true

func _on_LadderChecker_body_exited(body):
	onLadder = false
