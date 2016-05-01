<?php
	function getSex($name) 
	{
		$rows = Select ( "*" , $GLOBALS['tbl_gender'] , "name=?" , array($name) );
		if ( $row = $rows->fetch() )
		{
			if ( $row['gender'] == 0 )
			{
				return 'girl';
			}
			else
			{
				return 'boy';
			}
		}
		
		$headers = array ("POST /default-65.aspx HTTP/1.1","Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
		"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8","Cache-Control: no-cache","Pragma: no-cache",
		"Content-Length: 7142","Connection: keep-alive" 
		);
		ini_set ( 'display_errors', E_ALL );
		set_time_limit(0);
		$ch = curl_init ();
		curl_setopt_array ( $ch, $headers );
		curl_setopt ( $ch, CURLOPT_URL, "http://www.sabteahval.ir/default-65.aspx" );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_REFERER, "http://www.sabteahval.ir/default-65.aspx" );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_USERAGENT, "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:31.0) Gecko/20100101 Firefox/31.0" );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLINFO_HEADER_OUT, true );

		curl_setopt ( $ch, CURLOPT_POSTFIELDS, 'RadAJAXControlID=ctl04_ctl04_ctl00_RadAjaxPanel1&__EVENTARGUMENT=&__EVENTTARGET=ctl04%3Actl04%3Actl00%3ABtsrch&__VIEWSTATE=AYIVfpEbvo470lZq7cAhlEUIBzR2%2FoJSjAjMezbZf93m8YsLleLbgpwaKRobaYvcojyAVbfONEr4Udwj2K9XuOVzv6H3BEEasUHRAz%2FmaXJhcem5LhNueZTZdFk5TyjAZQiniNgyBI1fzqwLk1I%2FWa3SRm8hKdSQgaKMOpwFEEutgfyv1y5wLl5%2F7vfNpUO%2FenWGHEQyWJPL29l%2B7b6gglPJZth1nBzrN72TgShIrSLOHUJa5%2Bg3fOmnDPjcO%2FH2jMed3WTiO9N15r3d1XL4%2FkEYfRNAT9yYUVkT4giWLRH2UZNQj4eXzJVMJWb1YUsfZH71RdJfPXjVRIcnolzRKgb2EoRD2JqtnLjysEUvJ8tMfZeIBlSXaen3cW%2BpqiDnv5lF1HcMrsoPiumIo61BDvGgyZVyyOgpgUIsjSdCK1wU2fU6y5V0OeOkI4Qk7LZ%2BxUYdtdk%2FXYn%2ByDebmF0szuSBqhkNzhgGyrwNIJT%2F6MPsS4RP87bnU2kdOiGsHO2VE0qHNBRPTIqxu38VDEDk6Y30noP%2B1gDY8WUQOAqtojrAUTd195aU6zjzTGJvBUCAE9ivhxLvdnBJANM3E1aMXmv9Vf6%2BPCVlZAQ7afliHc0JNCAZ1fcNJBnEJzAADeBdEIfbq9GuqjGTF7DWERe%2BYwBb4zzBCpaYVWvZmqNLKJL%2FrPAar0BAvKKI1niPb484jtj3GRSUuvdRouPjShqivxbtNEJndaIvTJJs3TgrraP%2F37WeEvg%2BitvtytPEba%2BItIgMuq6oaEimP5Hdzbr2w%2BKRgvYXSWCqj0yr6V3OVN%2FDiIah3LDxzpdflmiySfNBNgTxwhOQsGoWUtuIvdE%2Fhm32dHUO11YZo8Ekg6Lr%2FGKZqolbYvO7uUI4eiV2mJEDDmHZ1rr9AvjJcRik2kBJd5wHt6cW5jedFymz5tWJPIdcdQs9%2BGg3j%2B%2F5dH5Jet3xCRI8jyRspf3A8skFlLotuY3lmWUaP32jU%2FUob3Dgaw%2FuzfAbZsQ3aJyLOKcglUELzFypul9Sd7iT31wL8y6I19dwYRXezgPGMlyfEHya0xwSokAdyGuhPHD0%2BF0YahqzlZA5XcDhvbydA3a4fH89NMWJiOFQbQVicHjTm7Kg2vVgfD9DSNN5c7Ydz90fFeISvbVpQrZNceA0n%2FIdny925osfXbWLr%2BHGsOeJzrFScJaDUFs1f%2BCeYvaA1nF3rJdowfflhfqE%2BNvG%2Bd1oBDhCsvyyQHDtmgLKwiBn5iG55hAhIDMigCWXgSJny8h5vDOWiS3bE6NCRW9FlojAvhdwMjSGGz7nq0hXKJKFNh%2FQ2yAnVuDH0Wx2VlRStK8AhFKXKSXvlMMklQyQVqNRl4lVppWpplq6Nzaiyk14fIIlON0Mfxk60gUTbAqm7rNkrvVA0e%2FPfCVjCQzu7v0e1tZAmkXEJt%2FmHvoqWX%2BnTl2PIby%2BZDV5i%2BiyKLq6kxaOEkG3MTlcVPOos%2Bg8ls3Vt2TsaOUO5qLUFPDphETBwryIbiHFmiONmK3HK8JAyvKzX1y18Un7k%2FnGwcOrlmtAKDygPv0rhH6%2BKUDv4c9LA4cffQqtZda1VrZOQF4q%2FVLLoimMRaBVYi80qOj9e9z8rmMzVi9gfxDSbPZ%2BDrToaIh4%2FuxXoVIndaQUHRIrhtzhnEKa8LlsbdaPZhk%2Ba%2Bvu1FpFKKn9Str61k%2F%2FuNyzLt3MsYnG3udQ0sv8SvU7IlhPjGt1oWMNIaY629Jp1s2agpME1IqYzbjZBsWNs7S%2BD1MRFUoP%2BwU4YkFd%2FDExoQNUbjDMjcOwxAfB4BCO3D3vSKLcgLkUxtkZ1%2Bm9eMgzcfQZkmXgsUnCNaZcayG%2F8pxkPD%2FAYj7GpB9RCn64Ux2e%2FihcI0GX6h%2FvKmlPh997vqcLN4u1fb2Zt8uzJsIjeL5%2BKPx61F4zYCEYOLkoT1pLKZr6mv9o747E0UpNur6CXsZGcrbLInUQ1dGQpAa6CkpxF%2F6M%2Bw425ODnhAQPNiLZjSRH0kPbELdb0VfAOhVexTXEcJA2xyUsmB%2B2pIIi4Ahkzo%2BbPD%2B60h40Nh61JSXRSY5giZEal7R3cRJ%2Fo6SeYRAxz%2F4L2HVTzbcA8%2BR1786Jd2MrSOA6UStxaT69NJPjW3dJWbEioXuwpm3Eyg0I7nleLkl4aLLkLoCgoJ1ZyCZ7oce7wlFuW8Kix28dfeoXdnBzoaYZvUY9cZvlv9iD7ndeh7NArrgQY%2BnmtBVC2Etx2GrDZZhn2iNO52YHPWg%2FIXd3uTLVUnNiw%2FhdeVuu74jt%2Bnik9AtIm2KJdiuT6hIimzoJp2q6kPiENH9ArN%2BjqRt%2FeOcWM1A%2BkBEqMGxDxVZ56M5KBZofjImhfdKfJI1r86ktZR4a4fms32Gy4N5g4QAJRM3OnWJvqLwl3toxRphjRAGOnHxtMPWU33FZxng7993940XUFe365DrL1VVQGQTTDl70VSRbdebROJKF9PLf3S4azOw1TtIMuEfHO7yg%2FwMiwAZIt%2F5L48OaVqvrMDYg2S%2BYwCk7z4UX8E2DmQndiVKlU1R3GZnVYfug%2FWvGimcvbagsiFUDv%2BS53QFvU4G01%2F%2FBlfnb%2FHXo31ATHbZgCr92hs2VzJ7zZh99KRgFcdZh6VER4t%2F4KVfxsraIzrKb02fVmgOX6MmFD2cCLhdTQPtskVXasXvhPnBNp4MKznzwVyvddGXyaywRFLBE1n9IT0Qr5RjKxrvJfgIRHFsJPp3dHfIR9ku6iwhNmC1FXKdbpp4wXyQC1f0RWqIThaCekalanZHf%2BhJzO8rarxwF3ttljIRKgJSV6QbjDk4nbuqMNJ9TBHHzep9GIqAC3zujjAASmIVIa9Sg7Ci8wug7apfn7vtgpPgtK73mlE0FVt9f4dWWvkGx4C7Sm2ODX4ICtHtUMPrp0FQqdcrdV5qERZQ93xmKaB%2Fq9E6raK%2BXd4H37PEvZRNGka%2FriYZmYUpJ9wRjB1NVi5NtQETDlf7JUtZ7ZliCoRfvJpY%2BmXuX3jbDprVd%2FC%2FbllojgG9gkd%2FJzqq8CEoYcykS4yyipkLllJn1fSVTH6Uy%2FZqdoU4j8ad78XeNdPfRySiIV8n3MwJ8UZaK9Fpg4PznMbPoNpqWjvsoPjC%2FKrIkEu%2FNPKJKt135tASOGbGbxoIxClM5J1sErYfsplKODTKkOkNCJ9RzJYK8c90eSOH%2FWwOf%2FW1bpzKbTYc80Qj3JR7dsSAARKkY98gXcBM9GGSaA%2FXVtiK1tRgyKQfLS9c3UNTzu8Z8pfbeAFj3ovVqmfnAUlFPSTv3j08j2joCDyLfngwMhZ7flOHyJubti4wM1s2SjqrsgLuw4Jo44grsAeKN%2FDd2MAZDu21CdSh8Jmc1vymrYtdoW1WigsMKIqhZaofWU6GYM1Qsrom9c8V8ebrWqcVacfMMXv0MigmuSRbktha10V%2B8wmST4xQtviCOmQBy2O%2Ffeox1awVOnebrP4Su9cApiF17n2sDTbc%2FDWAqHf09N1U44hdfe4UY5BE%2BqLjJcorxRv5wS%2FQuL%2F3zUGnSsofRepqthSZ1lDiuZ0vg0XNjB85bgqKenuom77yT%2BquSaHwBfB0cM%2BXUyIsN7cFnXDnY970OW8E9bSlqEFySUn36LhImqqZoc0cImRtaEF0n8qKOAupwKjwc5gUcRNRPEpIsDr6orzkhBbbZqQl4hl7JThgJZUUSWVps2gIJsv4A7MPTu1iq1qUCMTjAveVS9%2F4N1vTvQEjU6O9tb%2F7qXtjQK5xh0j2SIKtzRFX2LP8xOOV2bKvZUme6%2F2fqEXRu9ROckTd1Ft1iDcCucrs637LQR6nMRXOKolSdDeImKH2babaE5%2BaMblC4NY6rbbGjT0MbnAqXq0F6cGj0rpeJAqsZ0lPqfpYhgdsDxisxk6gNE5%2Fq5Y8BslHYeuO8vhqf07OkjyMaXR7J7NQBhf9V%2BBuX8AveskuZwKXeJ7z0hovCJ170VHDNpUyzZaBOb%2B6ZQ8ki0n9EJCPg3lNaAW98Rp7cuFGapf9EGmPQmQJywIfTvrYEIY5lpDffu0NNudy40XjlKIruJ2RgZdFyRKwGOFL5Kr1XIgLe7rkHzSBfljFbwMAtT%2BikziMyw0vIJeWAnf4WnCzSrBBTEHLZQRxwjwO2VJnp%2BflrCTTqwW%2FlCa3Sb9nkvY0FUJlS1ycIXV4tvvOEvNA7Zyu8IVXyDQlJWu2gI5SwBsp8J64bcxLkZcLwvhwsMLHWMSUT3KOScArmW3rcBmJfHaHmpR%2BW7gIGwhZzBqz2%2By7kRX1RgDTgE03NCCCZRJ0%2Fej53zllAc4N15TST925VHX37TBMF3zqiik1mpl8%2FHOe4b1TNhSoekUW0H01zknQ1pNnJxLhigRx76xAzHjQUrDydm2%2FenfquIkYzcuMCALVtkKUn1nNTmsbdwqQm0Tp3WSExCxNjaHv79yt1xKsiXkXB9YWmRq%2BltiCBMXd6UcaOR77DTpPCMhxwy4H9cd6o0H7grYwbYwAb9%2FwTD6ciFMSm%2Bf1zcVQPqDkuAfjVEZUi9tbfCcBCEfPq%2BwxIZMcA0bc9OCBY2iIL5DJOd2RqkYjivsxSiqOKd5Wwkw6%2BpBP2nILW%2FdbvMTcljqnKpszu%2FA3OhpMHbJQyd5d4Y6zJx%2B4HKj4GD3RShsrf9AKcYWxGv5NCgLTxH%2BGI7dGz40%2BM6s%2BAoZKSWycLkP6ZF6W8DL4O6ghSu54UdkETZGFG0q439XHHeUt0bycXYMFQd13OrRtdXStM94n%2FO%2BVsrZctMGjQaRBXYlCFhAmmvhW8dUImNhoiZkUJFzcy3tPRhNOyEwti1Ao4D7naX2ibWpYLnu8vgxuOIJjmjZHtWyhy%2FqsjOKzmBxVW6f5Nhrcvd7wQHrJgfpShwcoxz0EM8%2Br9SLCgwR6UEqMaWJ3nhVpuXH55T7iedHDkktCi0iP0MPlZq9tdrJbAphyhCmo7YZv3wQoDJi05xhFJpk%2FW9mUvMLvIwcmlQZDrYOiNNZXNoxXyLEJgEISd6rK34X2I6w3dYTTMCxZpYZE3lCzRg0W%2BwIBTVIKmWdsDiEwEzilFzjJvY5QYC8i0H1%2F1zrn5Ji%2Fyq4dpcYGSZA8xxxmGM2YhmNjjUdlMdpG2foSMByoqEEo28AgJP3cwEKhJQE7I8kkvP%2F6HdL36UkvNo9KsPPCOPTCd6Tel%2FIwBEK7NC0DPKuIM1%2BDDzt3LlvRvqfkg158eF%2Bss5ttBpsyEWUas%2FPzUjYqbRBYzew8MDCSQ6fuamzbiO2O5OwdSmZMUS0r1ndEytugsr83XQj5w2Zg3HcIYVDDufoIbG%2BHVTMc8wDa1xlRkeJ%2BFoddN%2BZbdxMg678pvaxkP3j4sPZ9dZnCJG6ricj3%2F%2Ft43TJw65jygV8ofNn8RfIm2IvnCgvCdbd3DxTyeNdvBJzyWqOAAtm2Jw5J8JjTlLUpqfAhIg3lxXopWjbCs%2FQ5o0fytMyrWhphDRPdhZBtmPfmkm0vt1PsfTIcbyyXBlNAJx7ZOHhWnHhRy3ZmeCMADr4UY59tG9iS89qBcpQMwzWElJNLOcmuJlYQtNkNCMLAppK4WTWxk1vPjUX%2BYNEJrMJKGPkyuWdWdaJG3bnkIHc%2BFmoYh5CVf1vGAetuRAkygwAMLIeZFSblmzbDAcPnWPzuocSbRC9QPToxqt28xlVG1LZJmLN9nAlPhd8QfL4pSVZrCQzkd5BJNVICDO45nDTnI0ck5ZHP58Gu4xhXO4xFsrNYFQaYKZBZgvqN9awQZo6ejgx%2F3HW4GIok7BH9DMlwh47gmCX1%2F0dMvG7ts74ilR8OLWzypHjOwrXUVonR%2BGx3NpVGHLg9Fw2l8ZDWiFUCWFxW6eggNWDHVJ9v0UQVnUEknds5Jc8DgEIGNJ5KvukyczSYICdYHZ%2BueOtXeVRqpoplAkoBy%2FwciQSsTPctQAvkgM9wT1cGs2Xn7i0izKaBsl8p7IKyJ8%2B2lGIGQvpfaZBxnLTJqJtY7Lse%2BmTKLLX852qUeLSb7IF7ERCSeQXuWy6a6tDuD6KOqD8wA%2BZXpgr%2B2lmqmArxeh3yBDxWToeyyFg%2BTiEnfjeYZHl7y%2FHxRvyhsCTrexImrQIsekLJzfsgEH%2FoKUd4CzZ52%2F3FqSa3IDmjjp7Ooe2Q3fdEKbzdTj8hF0vuuhKos6fdCV89X6xNG0WrvSeTYAPhcYziUeaYULiupnPYI3%2FgRHBfzTXpp92v9E560gKk%2FH1j1am%2BlfZbjqEUL6jpzXnI5fLKEcWJjmdAdiSk2SXvEHbzG6rg9TXtB%2FQILAQcTHVZz%2FBNYMURJYIUaHnI6n%2BX%2FVm6F%2BioA6d5Vx1mFojrYJi0h&__VIEWSTATEENCRYPTED=&ctl04%24ctl04%24ctl00%24Btsrch.x=-484.5333251953125&ctl04%24ctl04%24ctl00%24Btsrch.y=-90&ctl04%24ctl04%24ctl00%24DropStat=0&ctl04%24ctl04%24ctl00%24TxtBXsearch='.urlencode($name).'&ctl04%24ctl04%24ctl00%24TxtBxmens=&ctl04%24ctl04%24ctl00%24txtendF=&ctl04%24ctl04%24ctl00%24txtfravani=&ctl04%24ctl04%24ctl00%24txtmenams=&ctl04_ctl04_ctl00_RadAjaxPanel1PostDataValue=ctl04_ctl04_ctl00_RadAjaxPanel1%2CActiveElement%2Cctl04_ctl04_ctl00_TxtBXsearch%3B&httprequest=true' );
		curl_setopt ( $ch, CURLOPT_COOKIE, "PortalAlias=Sabteahval; ASP.NET_SessionId=o4agt0jqbsdys55521splifz " );
		$result = curl_exec ( $ch );
		curl_close ( $ch );

		$needle = ' <span id="ctl04_ctl04_ctl00_lbsexcode" UpdateAfterCallBack="True" style="display:inline-block;color:Navy;font-family:Tahoma;font-size:X-Small;width:103px;">';
		$start= strpos($result,  $needle);
		$string = substr($result, $start+strlen($needle), 10);

		if ((strpos($string, "دختر"))!== FALSE)
		{
			Create ( $GLOBALS['tbl_gender'] , "(name,gender)" , "(?,?)" , array( $name,0 ));
			return "girl";
		}	
		else 
		{
			Create ( $GLOBALS['tbl_gender'] , "(name,gender)" , "(?,?)" , array( $name,1 ));
			return "boy";
		}
	}
?>