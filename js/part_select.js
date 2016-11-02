$(document).ready(function() {
	$(document).click(function(event){
		if ($(event.target).closest(".select_list").length) return;
		if ($(event.target).closest(".part_select").length) return;
		$('.part_select').removeClass('open');
		event.stopPropagation();
	});
	$(".part_select").click(function() {
		$(this).toggleClass("open");
	});
	$(".select_list").click(function(event) {
		event.stopPropagation();
	});
	$(".select_list .select_group_cont li").click(function(){
		var checkbox = $(this).find("input");
		var checked = checkbox.prop("checked");
		checkbox.prop("checked",!checked);
		UpdateSummary();
	});
	$(".part_clear").click(function() {
		$(".select_group_cont input").prop("checked", false);
		UpdateSummary();
	});
	$(".part_close").click(function() {
		$('.part_select').removeClass('open');
		event.stopPropagation();
	});
	UpdateSummary();
	function UpdateSummary(){
		var checked = $(".select_list .select_group_cont li input:checked");
		var cont = $(".part_select > span");
		if(checked.length == 0) {
			cont.text("Тип исследования");
		} else {
			if(checked.length == 1) {
				cont.text(checked.parent().text());
			} else {
				cont.text("Типы (" + checked.length + ")");
			}
		}
	}
});