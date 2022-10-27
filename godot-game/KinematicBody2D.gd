extends KinematicBody2D

var MAX_SPEED = 600
var ANTI_SLIPPERY = 0.4 # pourcentage
var MAX_JUMP_TIME = 20 # en frame
var GRAVITY_FORCE = 70
var MAX_GRAVITY_FORCE = 2000 # pour la gravité seulement
var JUMP_FORCE = 1200

var jumpTime = 0
var velocity = Vector2(0,0)
var jumping = false

func _physics_process(delta):
	if Input.is_action_pressed("ui_left"):
		$Sprite.flip_h=true
		$Sprite.play("Walk")
		velocity.x = lerp(velocity.x,-MAX_SPEED,ANTI_SLIPPERY)
	elif Input.is_action_pressed("ui_right"):
		$Sprite.flip_h=false
		$Sprite.play("Walk")
		velocity.x = lerp(velocity.x,MAX_SPEED,ANTI_SLIPPERY)
	else :
		$Sprite.play("Idle")
	if not is_on_floor():
		$Sprite.play("Air")	
	elif Input.is_action_just_pressed("ui_up"):
		jumping = true
		velocity.y = -JUMP_FORCE
	if jumping and Input.is_action_pressed("ui_up") and jumpTime < MAX_JUMP_TIME:
		jumpTime+=1
		velocity.y += GRAVITY_FORCE/5
	else:
		jumpTime = 0
		jumping = false
		if velocity.y < MAX_GRAVITY_FORCE :
			velocity.y += GRAVITY_FORCE
	
	velocity = move_and_slide(velocity,Vector2.UP)
	velocity.x = lerp(velocity.x,0,ANTI_SLIPPERY)
		
	
