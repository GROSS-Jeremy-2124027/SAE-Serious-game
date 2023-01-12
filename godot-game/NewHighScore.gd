extends Label


func _on_Timer_timeout():
	if visible == true :
		visible = false
		get_node("Timer").wait_time = 0.75
	else :
		visible = true
		get_node("Timer").wait_time = 0.4
