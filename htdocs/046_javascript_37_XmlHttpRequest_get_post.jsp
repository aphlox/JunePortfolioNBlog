<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
request.setCharacterEncoding("utf-8");
String irum = request.getParameter("name");
String nai = request.getParameter("age");
String method = request.getMethod().toString();

out.print("메소드 : "+method +" - "+irum + "님의 나이는 " + nai);
%>