extends Node2D

var host = "http://127.0.0.1" # Sans le '/' à la fin
var actualScore
var questions = []
var httpActive : bool = false;
var isGetQuestionFinished : bool = false;
var nbErrors = 0

func _on_request_completed_get_question(result, response_code, headers, body):
	var response = parse_json(body.get_string_from_utf8())
	questions.append(response)
	httpActive = false

func get_question(nbQuest, level):
	isGetQuestionFinished = false
	$HTTPRequest.connect("request_completed", self, "_on_request_completed_get_question")
	for id in range(nbQuest) :
		httpActive = true
		$HTTPRequest.request(String(host)+"/query/commande.php?command=get_question&idQuestion="+String(id+level*4-3))
		while(httpActive):
			yield(get_tree(), "idle_frame")
	$HTTPRequest.disconnect("request_completed", self, "_on_request_completed_get_question")
	isGetQuestionFinished = true

func _on_request_completed_get_score(result, response_code, headers, body):
	var response = parse_json(body.get_string_from_utf8())
	actualScore = response
	httpActive = false
	pass

func get_score():
	if isGetQuestionFinished :
		$HTTPRequest.connect("request_completed", self, "_on_request_completed_get_score")
		httpActive = true
		$HTTPRequest.request(String(host)+"/query/commande.php?command=get_score")
		while(httpActive):
			yield(get_tree(), "idle_frame")
		$HTTPRequest.disconnect("request_completed", self, "_on_request_completed_get_score")

func add_score(score):
	$HTTPRequest.connect("request_completed", self, "disconnect")
	httpActive = true
	$HTTPRequest.request(String(host)+"/query/commande.php?command=add_score&score="+String(score))
	while(httpActive):
		yield(get_tree(), "idle_frame")
	$HTTPRequest.disconnect("request_completed", self, "disconnect")

func _ready():
	# player can't move while loading
	get_node("KinematicBody2D").set_physics_process(false)
	# set nbQuest
	var nbQuest = 0
	for i in range(get_child_count()):
		if get_child(i).name[0] == 'P' and get_child(i).name[1] == 'C' :
			nbQuest += 1
	get_node("CanvasLayer/Blackwait").visible = true
	randomize()
	get_question(nbQuest, int(name[-1]))
	while !isGetQuestionFinished:
		yield(get_tree(), "idle_frame")
	set_next_pc()
	get_score()
	get_node("CanvasLayer/Blackwait").visible = false
	get_node("CanvasLayer/Temps").visible = true
	# player can now move
	get_node("KinematicBody2D").set_physics_process(true)

func set_next_pc():
	if questions.size() >= get_node("KinematicBody2D").pcid :
		var idResponses = [1,2,3,4]
		idResponses.shuffle()
		get_node("CanvasLayer/ChatBox").indice = questions[get_node("KinematicBody2D").pcid-1]["indice"]
		var question = String(questions[get_node("KinematicBody2D").pcid-1]["tupleQuestion"])
		if question.length() > 45 :
			if question.length() > 90 :
				get_node("CanvasLayer/Sombre/Q1").text = question.insert(45,"\n").insert(90,"\n")
			else :
				get_node("CanvasLayer/Sombre/Q1").text = question.insert(45,"\n")
		else :
			get_node("CanvasLayer/Sombre/Q1").text = question
		while idResponses.size() > 0 : # On met les réponses dans les pc
			if String(questions[get_node("KinematicBody2D").pcid-1].values()[6-idResponses.size()]) != "" :
				get_node("CanvasLayer/Sombre/Q1/R" + String(idResponses[0])).visible = true
				get_node("CanvasLayer/Sombre/Q1/R" + String(idResponses[0]) + "/box/MarginContainer/HBoxContainer/Label").text = " " + String(questions[get_node("KinematicBody2D").pcid-1].values()[6-idResponses.size()]) + " "
			else :
				get_node("CanvasLayer/Sombre/Q1/R" + String(idResponses[0])).visible = false
			if questions[get_node("KinematicBody2D").pcid-1].values()[6-idResponses.size()] == questions[get_node("KinematicBody2D").pcid-1]["bonneReponse"] : # Si c'est la bonne réponse, on l'indique au script du pc
				get_node("PC" + String(get_node("KinematicBody2D").pcid)).idReponse = idResponses[0]
				get_node("PC" + String(get_node("KinematicBody2D").pcid)).ready = true
			idResponses.pop_front()
	else :
		end_game()

func end_game() :
	# Fin de partie
	#JavaScript.eval("window.location.href='../index.php'")
	var newScore = (1000000000/get_node("CanvasLayer/Temps/Valeur").time)*2 / (nbErrors+2)
	get_node("CanvasLayer/Temps/Valeur").gameRunning = false
	get_node("CanvasLayer/GameOver").visible = true
	get_node("CanvasLayer/GameOver/Temps").text = "Temps : " + get_node("CanvasLayer/Temps/Valeur").text
	get_node("CanvasLayer/GameOver/Erreurs").text = "Erreurs : " + String(nbErrors)
	get_node("CanvasLayer/GameOver/Score/ScoreValeur").text = String(newScore)
	if (newScore > actualScore) :
		get_node("CanvasLayer/GameOver/NewHighScore").visible = true
		add_score(newScore)
