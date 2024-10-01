<?php
// LDAP server information
$ldap_server = "ldap://example.com";
$ldap_port = 389;

// Create an LDAP connection
$ldap_conn = ldap_connect($ldap_server, $ldap_port);

if ($ldap_conn) {
  // LDAP authentication information
  $ldap_user = "cn=admin,dc=example,dc=com";
  $ldap_pass = "admin_password";

  // Open LDAP connection by authenticating
  $ldap_bind = ldap_bind($ldap_conn, $ldap_user, $ldap_pass);
  if ($ldap_bind) {
    // LDAP query to search for users
    $ldap_filter = "(objectClass=inetOrgPerson)";
    $ldap_search_base = "ou=users,dc=example,dc=com";
    $ldap_search = ldap_search($ldap_conn, $ldap_search_base, $ldap_filter);
    // Get results from LDAP query
    $ldap_entries = ldap_get_entries($ldap_conn, $ldap_search);
    // Display results
    print_r($ldap_entries);
  } else {
    echo "LDAP connection authentication error";
  }
  // Close LDAP connection
  ldap_close($ldap_conn);
} else {
  echo "Could not connect to LDAP server";
}